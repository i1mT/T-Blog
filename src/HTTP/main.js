import axios from "axios"

/**
 * 测试库/正式库 信息
 */
const DEV_ROOT =   'http://www.myblog.me/API/public/?s='
const PROD_ROOT = 'http://www.iimt.me/API/public/?s='
let ROOT = process.env.NODE_ENV === 'development' ? DEV_ROOT:PROD_ROOT


//设置axios为form-data形式
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
axios.defaults.headers.get['Content-Type'] = 'application/x-www-form-urlencoded';
axios.defaults.transformRequest = [function (data) {
  let ret = ''
  for (let it in data) {
    ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
  }
  return ret
}]


/**
 * 获取实api地址
 * @param {*} name api名
 */

function getUrl(name) {
  return ROOT + name
}

/**
 * 
 * 
 ***************************************** 文章类 ******************************************************
 * 
 * 
 */

/**
 * 获取一页文章
 * @param {*} page 
 * @param {*} length 
 */
function getPage(data) {
  if(!length) length = 8

  let url = getUrl("Article.GetCardPage")
  return axios.post(url, data)
}

/**
 * 根据id获取文章
 * @param {*} id 文章id
 */
function getArticleById(id) {
  let url = getUrl("Article.GetById")

  let data = {
    id: id
  }

  return axios.post(url, data)
}


/**
 * 文章点赞数+1
 * @param {*} id 文章id
 */
function addArticleLikeById(id) {
  let url = getUrl("Article.AddLike")
  let data = { id: id }

  return axios.post(url, data)
}

/**
 * 文章阅读数+1
 * @param {*} id 文章id
 */
function addArticleViewById(id) {
  let url = getUrl("Article.AddView")
  let data = { id: id }

  return axios.post(url, data)
}

/**
 * 
 *
 ******************************************** 评论类 *******************************
 * 
 */

/**
 * 获取文章所有评论
 * @param {*} id 文章id
 */
function getCommentsByAid(id) {
  let url = getUrl("Comment.GetAllByArticleId")
  let data = { id: id }

  return axios.post(url, data)
}

/**
 * 评论点赞数+1
 * @param {*} id 评论id
 */
function addCommentLikeById(id) {
  let url = getUrl("Comment.AddLikes")
  let data = { id: id }

  return axios.post(url, data)
}

/**
 * 插入一条评论
 * @param {Comment} data 评论数据
 */
function addComment(data) {
  let url = getUrl("Comment.Add")

  return axios.post(url, data)
}

/**
 * 
 *********************************************** 友情链接 ***************************************
 * 
 */

 /**获取所有友情链接 */
 function getAllFriends () {
   let url = getUrl("Friends.getAll")

   return axios.post(url)
 }

 /**添加一个友情链接 */
 function addFriend (data) {
   let url = getUrl("Friends.add")

   return axios.post(url, data)
 }


 /**
  *
  * 
  * 
  ********************************************* 动态类 ****************************************
  *  
  *
  */


 /**
  * 获取一页动态
  */

function getActivity(data) {
  let url = getUrl("Activity.getPage")

  return axios.post(url, data)
}

/**
 * 
 ******************************************** 工具类 ********************************
 * 
 */

 /** 获取axios实例 */
 function getInstance () {
   return axios
 }



export default {
  getPage,
  getArticleById,
  addArticleLikeById,
  addArticleViewById,
  getCommentsByAid,
  addCommentLikeById,
  addComment,
  getAllFriends,
  addFriend,
  getInstance,
  getActivity
}