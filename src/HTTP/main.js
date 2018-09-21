import axios from "axios"

/**
 * 测试/调试库/正式库 信息
 */
let IS_TEST = false
let TEST_ROOT = "http://localhost/T-Blog/API/public/?s="
let PROD_ROOT = "http://iimt.me/API/public/?s="


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
  let base = IS_TEST ? TEST_ROOT : PROD_ROOT
  return base + name
}

/**
 * 获取一页文章
 * @param {*} page 
 * @param {*} length 
 */
function getPage(page, length) {
  if(!length) length = 8

  let url = getUrl("Article.GetCardPage")
  let data = {
    page: page,
    pageNum: length,
  }
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

export default {
  getPage,
  getArticleById,
  addArticleLikeById,
  addArticleViewById,
  getCommentsByAid,
  addCommentLikeById,
  addComment,
}