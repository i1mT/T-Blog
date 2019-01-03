<template>
  <div class="header">
    <div class="logo">{{ adminName }}</div>
    <div class="user-info">
      <el-dropdown trigger="click" @command="handleCommand">
        <span class="el-dropdown-link">
          <img
            class="user-logo"
            src="http://upy.iimt.me/2018/12/27/upload_9f58ae4ed5b4e21f0e53f713bbbdb001.jpg"
          >
          {{nickname}}
        </span>
        <el-dropdown-menu slot="dropdown">
          <el-dropdown-item command="loginout">退出</el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
    <div class="to-myblog">
      <a href="http://www.iimt.me" target="_blank">查看博客</a>
    </div>
    <el-dropdown class="nav-menu-dropdown" placement="top-end" @command="handleNavCommand">
      <span class="el-dropdown-link">菜单
        <i class="el-icon-arrow-down el-icon--right"></i>
      </span>
      <el-dropdown-menu slot="dropdown">
        <el-dropdown-item v-for="(item, i) in liteNavs" :key="i" :command="item.index">
          {{ item.name }}
        </el-dropdown-item>
      </el-dropdown-menu>
    </el-dropdown>
  </div>
</template>
<script>
export default {
  data() {
    return {
      liteNavs: [
        {
          name: '概况',
          index: '/Situation'
        },
        {
          name: '文章',
          index: '/article'
        },
        {
          name: '动态',
          index: '/activity'
        },
        {
          name: '分类',
          index: '/cate'
        },
        {
          name: '管理',
          index: '/ManageBlog'
        },
      ],
      adminName: "T",
      nickname: "",
      username: "",
      islogin: "",
      id: "",
      name: ""
    };
  },
  mounted() {
    this.getAdminInfo();
  },
  methods: {
    handleNavCommand (command) {
      this.$router.push(command)
    },
    handleCommand(command) {
      if (command == "loginout") {
        const that = this;
        that.$axios.post(that.$API.Admin.logout).then(res => {
          this.$router.push("/login");
        });
      }
    },
    getAdminInfo() {
      const that = this;
      that.$axios.get(that.$API.Admin.getAdminInfo).then(res => {
        let admin = res.data.data;
        that.nickname = admin.nickname;
        that.username = admin.username;
        that.name = admin.nickname;
        that.islogin = admin.islogin;
        that.id = admin.id;
      });
    }
  }
};
</script>
<style scoped>
.header {
  position: relative;
  box-sizing: border-box;
  width: 100%;
  height: 70px;
  font-size: 22px;
  line-height: 70px;
  color: #fff;
}
.header .logo {
  float: left;
  padding: 0 5rem;
  text-align: center;
}
.user-info {
  float: right;
  padding-right: 50px;
  font-size: 16px;
  color: #fff;
}
.to-myblog {
  float: right;
  padding-right: 50px;
  cursor: pointer;
}
.to-myblog a {
  text-decoration: none;
  font-size: 15px;
  color: #bfcbd9;
}
.user-info .el-dropdown-link {
  position: relative;
  display: inline-block;
  padding-left: 50px;
  color: #fff;
  cursor: pointer;
  vertical-align: middle;
}
.user-info .user-logo {
  position: absolute;
  left: 0;
  top: 15px;
  width: 40px;
  height: 40px;
  border-radius: 50%;
}
.el-dropdown-menu__item {
  text-align: center;
}
.nav-menu-dropdown {
  display: none;
}
.nav-menu-dropdown span {
  color: #bfcbd9;
}

@media screen and (max-width: 600px) {
    .to-myblog {
        padding-right: 2px;
    }
    .header .logo {
        padding: 0 1rem;
    }
    .nav-menu-dropdown {
      display: inline-block;
    }
}
</style>
