<div class="w-100">
    <h4>{{ lang.EDIT_PROFILE.SECTION_TITLE }}</h4>
</div>
<div class="w-100">
    <div id="profile-edit" class="boxed boxed--sm boxed--border">
        <div class="row">
            <div class="col-md-12 row-flex">
                <avatar class="user-avatar size-25-avatar" v-bind:account="state.user"></avatar>
                <div class="col-info-user">
                    <span class="h5">{{ profile.publicName || ''}}</span>
                    <p class="mb-2 nameUser">{{ '@' + state.user.name }}</p>
                    <a href="" v-on:click="loadAvatar">{{ lang.EDIT_PROFILE.CHANGE_IMAGE }}</a>
                    <input id="profile-edit-input-avatar" class="hidden" type="file" accept="image/*" v-on:change="onLoadAvatar" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label>{{ lang.EDIT_PROFILE.PUBLIC_NAME }}</label>
                <input class="validate-required" type="text" v-bind:maxlength="CONSTANTS.TEXT_MAX_SIZE.PROFILE.PUBLIC_NAME"
                       v-model="profile.publicName"
                       v-bind:placeholder="lang.EDIT_PROFILE.INPUT_PUBLIC_NAME"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>{{ lang.EDIT_PROFILE.ABOUT }}</label>
                <input class="validate-required" type="text" v-bind:maxlength="CONSTANTS.TEXT_MAX_SIZE.PROFILE.ABOUT"
                       v-model="profile.about"
                       v-bind:placeholder="lang.EDIT_PROFILE.INPUT_ABOUT" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>WEB</label>
                <input class="validate-required" type="text" v-bind:maxlength="CONSTANTS.TEXT_MAX_SIZE.PROFILE.WEB"
                       v-model="profile.web"
                       v-bind:placeholder="lang.EDIT_PROFILE.INPUT_WEBSITE" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>{{ lang.EDIT_PROFILE.CONTACT_INFO }}</label>
                <input class="validate-required" type="text" v-bind:maxlength="CONSTANTS.TEXT_MAX_SIZE.PROFILE.CONTACT"
                       v-model="profile.contact"
                       v-bind:placeholder="lang.EDIT_PROFILE.INPUT_CONTACT_INFO" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>{{ lang.EDIT_PROFILE.TAGS }}</label>
                <input id="profile-edit-tags" class="validate-required" data-role="tagsinput"
                       v-bind:placeholder="lang.EDIT_PROFILE.INPUT_TAGS" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>{{ lang.EDIT_PROFILE.LANGUAGE }}</label>
                <div class="input-select">
                    <select v-model="profile.lang">
                        <option v-for="l in isoLangs" v-bind:value="l.code">{{ l.nativeName }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>{{ lang.EDIT_PROFILE.ADULT_CONTENT }}</label>
                <div class="input-select">
                    <select v-model="profile.adult_content">
                        <option disabled value="">{{ lang.EDIT_PROFILE.SELECT_OPTION }}</option>
                        <option value="hide">{{ lang.PROFILE_SETTINGS.ADULT_HIDE }}</option>
                        <option value="warn">{{ lang.PROFILE_SETTINGS.ADULT_WARN }}</option>
                        <option value="show">{{ lang.PROFILE_SETTINGS.ADULT_SHOW }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>{{ lang.EDIT_PROFILE.POST_REWARDS }}</label>
                <div class="input-select">
                    <select v-model="profile.post_rewards">
                        <option disabled value="">{{ lang.EDIT_PROFILE.SELECT_OPTION }}</option>
                        <option value="0">{{ lang.PROFILE_SETTINGS.REWARDS_DECLINE }}</option>
                        <option value="50">{{ lang.PROFILE_SETTINGS.REWARDS_50_50 }}</option>
                        <option value="100">{{ lang.PROFILE_SETTINGS.REWARDS_100 }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>{{ lang.EDIT_PROFILE.COMMENT_REWARDS }}</label>
                <div class="input-select">
                    <select v-model="profile.comment_rewards">
                        <option disabled value="">{{ lang.EDIT_PROFILE.SELECT_OPTION }}</option>
                        <option value="0">{{ lang.PROFILE_SETTINGS.REWARDS_DECLINE }}</option>
                        <option value="50">{{ lang.PROFILE_SETTINGS.REWARDS_50_50 }}</option>
                        <option value="100">{{ lang.PROFILE_SETTINGS.REWARDS_100 }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="btn btn--sm btn--primary" v-on:click="sendAccountUpdate">
                    <span class="btn__text font-weight-bold">
                        {{ lang.BUTTON.SAVE }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
