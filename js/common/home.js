/**
 * Created by ander on 9/10/18.
 */

(function () {
    let homePosts;
    let lastPage;
    let session, account;

    /**
     *
     * @param {string} urlFilter
     * @param {string} filter
     * @param state
     * @returns {License}
     */
    function showPosts(urlFilter, filter, state) {
        console.log(urlFilter, filter, state);

        let content = state.content;
        let accounts = state.accounts;

        let cKeys = Object.keys(content);
        let newKeys = [];

        for (let x = 0; x < cKeys.length; x++) {
            let k = cKeys[x];
            if (!content[k].parent_author) {
                content[k].metadata = jsonify(content[k].json_metadata);
                newKeys.push(k);
            }
        }

        state.content = content;

        let aKeys = Object.keys(accounts);
        aKeys.forEach(function (k) {
            accounts[k] = parseAccount(accounts[k]);
        });

        state.accounts = accounts;

        //Normalize filter
        if (filter.startsWith('/')) {
            filter = filter.substring(1);
        }

        let category = resolveFilter('/' + getPathPart()).replace('/', '');
        let discuss = getPathPart(1) || '';

        if (isUserFeed(getPathPart()) && !state.discussion_idx[discuss]) {
            cKeys = newKeys;
            cKeys.sort(function (k1, k2) {
                let d1 = toLocaleDate(content[k1].created);
                let d2 = toLocaleDate(content[k2].created);

                return d2.getTime() - d1.getTime();
            });

            state.discussion_idx[discuss] = {};
            state.discussion_idx[discuss][category] = cKeys;
            lastPage = lastPage ? lastPage : 1;
        } else if (window.location.pathname === '/search') {
            lastPage = getParameterByName('page') || 1;
        } else {
            let contentArray = state.discussion_idx[discuss][category];
            lastPage = state.content[contentArray[contentArray.length-1]];
        }

        console.log('Filter:', filter, 'discussion:', discuss, 'category:', category, state.discussion_idx[discuss][category]);

        if (!homePosts) {
            homePosts = new Vue({
                el: '#home-posts',
                data: {
                    session: session,
                    account: account,
                    filter: filter,
                    category: category,
                    discuss: discuss,
                    urlFilter: urlFilter,
                    state: state,
                    search: getParameterByName('query'),
                    lang: getLanguage(),
                },
                updated: function () {
                    if (mr.masonry) {
                        console.log ('Updating layout');
                        mr.masonry.windowLoad();
                        mr.masonry.updateLayout();
                    }
                },
                methods: {
                    getDefaultAvatar: R.getAvatar,
                    onFollow: function (err, result) {
                        //creaEvents.emit('crea.content.filter', this.urlFilter);
                        updateUserSession();
                    },
                    openPost: showPost,
                    parseAsset: function (asset) {
                        return Asset.parse(asset).toFriendlyString();
                    },
                    getBuzz: function (reputation) {
                        return crea.formatter.reputation(reputation);
                    },
                    getFeaturedImage: function (post) {
                        let featuredImage = post.metadata.featuredImage;
                        if (featuredImage && featuredImage.hash) {
                            return {
                                url: apiOptions.ipfs + featuredImage.hash
                            }
                        } else if (featuredImage && featuredImage.url) {
                            return featuredImage;
                        }

                        return {};
                    },
                    getTags: function (post) {
                        let tags = post.metadata.tags;
                        let linkedTags = [];

                        //Select only 8 first tags
                        tags = tags.slice(0, 7);
                        tags.forEach(function (t) {
                            linkedTags.push('<a href="/search?page=1&query=' + encodeURIComponent(t) + '">' + t + '</a>');
                        });

                        return linkedTags.join(', ');

                    },
                    getFutureDate: function (date) {
                        return moment(toLocaleDate(date)).fromNow();
                    },
                    hasPaid: function (post) {
                        let now = new Date();
                        let payout = toLocaleDate(post.cashout_time);
                        return now.getTime() > payout.getTime();
                    },
                    getPayoutPostDate: function (post) {
                        let date = toLocaleDate(post.cashout_time);
                        if (this.hasPaid(post)) {
                            date = toLocaleDate(post.last_payout);
                        }

                        return moment(date).fromNow();
                    },
                    hasPromotion: function (post) {
                        let amount = Asset.parseString(post.promoted);
                        return amount.amount > 0;
                    },
                    getPromotion: function (post) {
                        let amount = Asset.parseString(post.promoted);

                        return '$ ' + amount.toPlainString();
                    },
                    getPayout: function (post) {
                        let amount = Asset.parseString(post.pending_payout_value);
                        if (this.hasPaid(post)) {
                            amount = Asset.parseString(post.total_payout_value);
                            amount = amount.add(Asset.parseString(post.curator_payout_value));
                        }

                        amount.amount = parseInt(amount.amount / (amount.amount / 1500));
                        return '$ ' + amount.toPlainString();
                    },
                    getPendingPayouts: function (post) {
                        const PRICE_PER_CREA = Asset.parse({ amount: Asset.parseString(this.state.feed_price.base).toFloat() / Asset.parseString(this.state.feed_price.quote).toFloat(), nai: 'cbd'});
                        const CBD_PRINT_RATE = this.state.props.cbd_print_rate;
                        const CBD_PRINT_RATE_MAX = 10000;

                        let payout = Asset.parseString(post.pending_payout_value);
                        payout.amount = parseInt(payout.amount / (payout.amount / 1500));

                        const PENDING_PAYOUT = payout;
                        const PERCENT_CREA_DOLLARS = post.percent_crea_dollars / 20000;
                        const PENDING_PAYOUT_CBD = Asset.parse({ amount: PENDING_PAYOUT.toFloat() * PERCENT_CREA_DOLLARS, nai: 'cbd'});
                        const PENDING_PAYOUT_CGY = Asset.parse({ amount: (PENDING_PAYOUT.toFloat() - PENDING_PAYOUT_CBD.toFloat()) / PRICE_PER_CREA.toFloat(), nai: 'cgy'});
                        const PENDING_PAYOUT_PRINTED_CBD = Asset.parse({ amount: PENDING_PAYOUT_CBD.toFloat() * (CBD_PRINT_RATE / CBD_PRINT_RATE_MAX), nai: 'cbd'});
                        const PENDING_PAYOUT_PRINTED_CREA = Asset.parse({ amount: (PENDING_PAYOUT_CBD.toFloat() - PENDING_PAYOUT_PRINTED_CBD.toFloat()) / PRICE_PER_CREA.toFloat(), nai: 'crea'});

                        return '(' + PENDING_PAYOUT_PRINTED_CBD.toFriendlyString(null, false) +
                            ', ' + PENDING_PAYOUT_PRINTED_CREA.toFriendlyString(null, false) +
                            ', ' + PENDING_PAYOUT_CGY.toFriendlyString(null, false) + ')';

                    },
                    parseJSON: function (strJson) {

                        if (strJson && strJson.length > 0) {
                            try {
                                return JSON.parse(strJson);
                            } catch (e) {
                                catchError(e);
                            }
                        }

                        return {};
                    },
                    onVote: function (err, result) {
                        //creaEvents.emit('crea.content.filter', this.urlFilter);
                        updateUserSession();
                    },
                    getLicense(flag) {
                        if (flag) {
                            return License.fromFlag(flag);
                        }

                        return new License(LICENSE.FREE_CONTENT);
                    }
                }
            })
        } else {
            homePosts.session = session;
            homePosts.account = account;
            homePosts.filter = filter;
            homePosts.category = category;
            homePosts.discuss = discuss;
            homePosts.state = state;
            homePosts.urlFilter = urlFilter;
            homePosts.search = getParameterByName('query');
        }

        homePosts.$forceUpdate();
        creaEvents.emit('crea.dom.ready');
    }

    creaEvents.on('crea.posts', function (urlFilter, filter, state) {

        let authors = [];
        for (let c in state.content) {
            let author = state.content[c].author;
            if (!authors.includes(author)) {
                authors.push(author);
            }

            //separate votes
            state.content[c] = parsePost(state.content[c]);
        }

        if (isUserFeed(getPathPart())) {
            //Retrieve another accounts
            getAccounts(authors, function (err, result) {
                if (!catchError(err)) {
                    let accounts = {};
                    result.forEach(function (a) {
                        accounts[a.name] = a;
                    });

                    if (homePosts) {
                        //On Session update

                        //Accounts
                        for (let a in accounts) {
                            homePosts.state.accounts[a] = accounts[a];
                        }

                        //Posts
                        for (let c in state.content) {
                            homePosts.state.content[c] = parsePost(state.content[c]);
                        }

                        state = homePosts.state;
                    } else {
                        state.accounts = accounts;
                    }

                    showPosts(urlFilter, filter, state);
                }
            })

        } else if (homePosts && homePosts.urlFilter === urlFilter && urlFilter === '/search') {
            let query = getParameterByName('query');
            if (query === homePosts.search && query !== null ) {
                //Accounts
                for (let a in state.accounts) {
                    homePosts.state.accounts[a] = parseAccount(state.accounts[a]);
                }

                //Posts
                for (let c in state.content) {
                    homePosts.state.content[c] = parsePost(state.content[c]);
                }

                //Order
                let newPosts = state.discussion_idx[""].search;
                for (let x = 0; x < newPosts.length; x++) {
                    if (!homePosts.state.discussion_idx[''].search.includes(newPosts[x])) {
                        homePosts.state.discussion_idx[''].search.push(newPosts[x]);
                    }
                }

            } else {
                showPosts(urlFilter, filter, state);
            }
        } else {

            if (homePosts && homePosts.urlFilter === urlFilter) {
                //On Session update

                //Accounts
                for (let a in state.accounts) {
                    homePosts.state.accounts[a] = parseAccount(state.accounts[a]);
                }

                //Posts
                for (let c in state.content) {
                    homePosts.state.content[c] = parsePost(state.content[c]);
                }

                state = homePosts.state;
            }

            showPosts(urlFilter, filter, state);
        }


    });

    function beforeInit(urlFilter) {
        let path = window.location.pathname;
        if (path === '/') {
            if (session) {
                urlFilter = urlFilter ? urlFilter : '/@' + session.account.username + '/feed';
                creaEvents.emit('crea.content.filter', urlFilter);
            } else {
                creaEvents.emit('crea.content.filter', '/popular');
            }
        } else {
            if (path.startsWith('/search')) {
                let search = getParameterByName('query');
                let page = getParameterByName('page') || 1;
                performSearch(search, page, true);
            } else {
                creaEvents.emit('crea.content.filter', path);
            }
        }
    }

    creaEvents.on('crea.session.update', function (s, a) {
        homePosts.session = session = s;
        homePosts.account = account = a;

        beforeInit(homePosts.urlFilter);
    });

    creaEvents.on('crea.session.login', function (s, a) {
        session = s;
        account = a;

        beforeInit();
    });

    let onScrollCalling;
    creaEvents.on('crea.scroll.bottom', function () {
        if (!onScrollCalling) {
            onScrollCalling = true;
            if (isUserFeed()) {
                let http = new HttpClient(apiOptions.apiUrl + '/creary/feed');

                http.when('done', function (response) {
                    let data = jsonify(response).data;

                    if (data.length) {
                        let count = data.length;
                        let discussions = [];
                        let accounts = [];
                        let onContentFetched = function () {
                            count--;
                            if (count <= 0) {
                                getAccounts(accounts, function (err, newAccounts) {
                                    if (!catchError(err)) {
                                        //Update accounts
                                        newAccounts.forEach(function (a) {
                                            homePosts.state.accounts[a.name] = parseAccount(a);
                                        });

                                        //Sort
                                        discussions.sort(function (k1, k2) {
                                            let d1 = toLocaleDate(k1.created);
                                            let d2 = toLocaleDate(k2.created);

                                            return d2.getTime() - d1.getTime();
                                        });

                                        let discuss = homePosts.discuss;
                                        let category = homePosts.category;

                                        //Update Posts
                                        discussions.forEach(function (d) {
                                            let permlink = d.author + '/' + d.permlink;
                                            homePosts.state.content[permlink] = d;
                                            homePosts.state.discussion_idx[discuss][category].push(permlink);
                                        });

                                        homePosts.$forceUpdate();
                                    }
                                    onScrollCalling = false;
                                })
                            } else {
                                onScrollCalling = false;
                            }
                        };

                        data.forEach(function (d) {
                            let permlink = d.author + '/' + d.permlink;
                            if (!homePosts.state.content[permlink]) {
                                crea.api.getContent(d.author, d.permlink, function (err, result) {
                                    if (err) {
                                        console.error('Error getting', permlink, err);
                                    } else {
                                        discussions.push(parsePost(result));

                                        if (!homePosts.state.accounts[d.author] && !accounts.includes(d.author)) {
                                            accounts.push(d.author);
                                        }
                                    }

                                    onContentFetched()
                                })
                            }

                        })
                    } else {
                        onScrollCalling = false;
                        --lastPage;
                    }
                });

                http.when('fail', function (jqXHR, textStatus, errorThrown) {
                    onScrollCalling = false;
                    catchError(textStatus)
                });

                let username = getPathPart().replace('/', '').replace('@', '');
                crea.api.getFollowing(username, '', 'blog', 1000, function (err, result) {
                    if (!catchError(err)) {

                        let followings = [];
                        result.following.forEach(function (f) {
                            followings.push(f.following);
                        });

                        if (followings.length) {
                            followings = followings.join(',');
                            refreshAccessToken(function (accessToken) {
                                http.headers = {
                                    Authorization: 'Bearer ' + accessToken
                                };

                                lastPage++;
                                http.post({
                                    following: followings,
                                    page: lastPage
                                })
                            })

                        }
                    }
                });

            } else if (window.location.pathname === '/search') {
                let query = getParameterByName('query');
                let postCount = Object.keys(homePosts.state.content).length;

                if (postCount > 0 && (postCount % 20) === 0) {
                    globalLoading.show = true;
                    performSearch(query, ++lastPage, true, function () {
                        onScrollCalling = false;
                        globalLoading.show = false;
                    });

                }

            } else {
                let apiCall;
                let category = homePosts.category;

                switch (category) {
                    case 'created':
                        apiCall = crea.api.getDiscussionsByCreated;
                        break;
                    case 'hot':
                        apiCall = crea.api.getDiscussionsByHot;
                        break;
                    case 'promoted':
                        apiCall = crea.api.getDiscussionsByPromoted;
                        break;
                    case 'trending':
                        apiCall = crea.api.getDiscussionsByTrending;
                        break;
                }

                apiCall(lastPage.author, lastPage.permlink, 21, function (err, result) {
                    if (err) {
                        console.error(err);
                    } else {
                        //Get new accounts
                        let discussions = result.discussions;

                        //Remove first duplicate post
                        discussions.shift();

                        let accounts = [];

                        for (let x = 0; x < discussions.length; x++) {
                            let  d = discussions[x];
                            discussions[x] = parsePost(d);
                            if (!homePosts.state.accounts[d.author] && !accounts.includes(d.author)) {
                                accounts.push(d.author)
                            }
                        }

                        //Get new accounts
                        getAccounts(accounts, function (err, newAccounts) {
                            if (!catchError(err)) {

                                //Update accounts
                                newAccounts.forEach(function (a) {
                                    homePosts.state.accounts[a.name] = a;
                                });

                                //Update Posts
                                discussions.forEach(function (d) {
                                    let permlink = d.author + '/' + d.permlink;
                                    homePosts.state.content[permlink] = d;

                                    let discuss = homePosts.discuss;
                                    homePosts.state.discussion_idx[discuss][category].push(permlink);
                                });

                                lastPage = discussions[discussions.length-1];
                                homePosts.$forceUpdate();
                            }

                            onScrollCalling = false;
                        })
                    }
                })

            }
        }

    });

    creaEvents.on('crea.search.content', function (data) {

        let searchState = {
            content: {},
            accounts: {},
            discussion: []
        };

        let count = 0;
        let onFinish = function (state) {
            count++;

            if (count >= data.length) {
                console.log(state);
                state.content = searchState.content;
                state.accounts = searchState.accounts;

                //Sort by active_votes

                searchState.discussion.sort(function (c1, c2) {
                    return state.content[c2].active_votes.length - state.content[c1].active_votes.length
                });

                state.discussion_idx[""] = {};
                state.discussion_idx[""].search = searchState.discussion;
                creaEvents.emit('crea.posts', '/search', 'search', state);
            }
        };

        for (let x  = 0; x < data.length; x++) {

            let getState = function (r) {
                let permalink = r.author + '/' + r.permlink;
                let url = '/' + r.tags[0] + '/@' + permalink;

                crea.api.getState(url, function (err, result) {
                    if (err) {
                        console.error(err);
                        getState(r);
                    } else  {
                        searchState.discussion.push(permalink);
                        searchState.accounts[r.author] = result.accounts[r.author];
                        searchState.content[permalink] = result.content[permalink];
                        onFinish(result);
                    }
                })
            };

            getState(data[x]);

        }

        if (data.length === 0) {
            crea.api.getState('/no_results', function (err, result) {
                if (!catchError(err)) {
                    onFinish(result);
                }
            })

        }
    });

})();

