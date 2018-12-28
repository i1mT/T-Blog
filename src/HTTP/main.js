import axios from "axios"

/**
 * 测试/调试库/正式库 信息
 */
const DEV_ROOT =   'http://www.myblog.me/API/public/?s='
const PROD_ROOT = 'http://www.iimt.me/API/public/?s='
let ROOT = process.env.NODE_ENV === 'development' ? DEV_ROOT:PROD_ROOT


//设置axios为form-data
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
axios.defaults.headers.get['Content-Type'] = 'application/x-www-form-urlencoded';
axios.defaults.transformRequest = [function (data) {
  let ret = ''
  for (let it in data) {
    ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
  }
  return ret
}]



function getUrl(name) {
  return ROOT + name
}

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

function getArticleById(id) {
  let url = getUrl("Article.GetById")

  let data = {
    id: id
  }

  return axios.post(url, data)
}

function addArticleLikeById(id) {
  let url = getUrl("Article.AddLike")
  let data = { id: id }

  return axios.post(url, data)
}

function addArticleViewById(id) {
  let url = getUrl("Article.AddView")
  let data = { id: id }

  return axios.post(url, data)
}

function getCommentsByAid(id) {
  let url = getUrl("Comment.GetAllByArticleId")
  let data = { id: id }

  return axios.post(url, data)
}

function addCommentLikeById(id) {
  let url = getUrl("Comment.AddLikes")
  let data = { id: id }

  return axios.post(url, data)
}

function addComment(data) {
  let url = getUrl("Comment.Add")

  return axios.post(url, data)
}

/**
 * 
 * 友情链接
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
}