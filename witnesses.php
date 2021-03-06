<?php include ('element/navbar.php'); ?>
<div class="main-container">
    <section v-cloak id="witnesses" class="space--sm">
        <div class="container post-container-home">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-explorer">{{ lang.WITNESS.VOTE_TITLE }}</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="border--round table--alternate-row table-vote">
                    <thead>
                    <tr>
                        <th style="width: 10%;"></th>
                        <th>{{ lang.WITNESS.VOTE_WITNESSES }}</th>
                        <th>{{ lang.WITNESS.VOTE_INFORMATION }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="x in state.ordered_witnesses">
                        <tr>
                            <td>
                                <witness-like v-bind:index="state.ordered_witnesses.indexOf(x) + 1"
                                              v-bind:account="account ? account.user : false"
                                              v-bind:session="session"
                                              v-bind:witness="state.witnesses[x]"
                                              v-on:vote="onVote"></witness-like>
                            </td>
                            <td><a v-bind:href="'/@' + x">{{ x }}</a></td>
                            <td><a v-bind:href="state.witnesses[x].url">{{ state.witnesses[x].url }}</a> </td>
                        </tr>
                    </template>

                    </tbody>
                </table>
            </div>

        </div>
    </section>
    <script src="/js/common/witness.js"></script>


<?php include ('element/footer.php'); ?>