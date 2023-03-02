/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : shop

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 17/08/2019 16:28:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adminuser` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `adminpass` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  `login_at` datetime NOT NULL,
  `login_ip` bigint(20) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', '0192023a7bbd73250516f069df18b500', '2019-01-23 20:21:03', '2019-01-24 12:56:48', 2130706433);

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `products` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES (2, 21700.00, 3, '{\"3\":{\"quantity\":2,\"product\":{\"id\":\"3\",\"name\":\"Macbook Pro\",\"price\":\"8800.00\",\"code\":\"88888888\",\"description\":\"Macbook Pro\"}},\"4\":{\"quantity\":1,\"product\":{\"id\":\"4\",\"name\":\"\\u534e\\u4e3a\\u624b\\u673a\",\"price\":\"4100.00\",\"code\":\"929868123123123\",\"description\":\"\\u5546\\u54c1\\u63cf\\u8ff0\\uff1a\\r\\n\\r\\n\\u8fd9\\u662f\\u534e\\u4e3a\\u624b\\u673a\"}}}', 5, '2019-01-24 10:53:24');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `products` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `uid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (1, 17600.00, 2, '{\"3\":{\"quantity\":2,\"product\":{\"id\":\"3\",\"name\":\"Macbook Pro\",\"price\":\"8800.00\",\"code\":\"88888888\",\"description\":\"Macbook Pro\"}}}', 5, '2019-01-24 12:46:33');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `price` decimal(10, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (3, 'Macbook Pro', '88888888', 'Macbook Pro', 99, 8800.00, '2019-01-24 00:19:28');
INSERT INTO `product` VALUES (4, '华为手机', '929868123123123', '商品描述：\r\n\r\n这是华为手机', 99, 4100.00, '2019-01-24 00:31:28');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `age` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (3, 'zhangsan', '4297f44b13955235245b2497399d7a93', '张三', 28, '13912345678@qq.com', '13912345678', '2019-01-23 23:54:34');
INSERT INTO `user` VALUES (4, 'wangwu', '4297f44b13955235245b2497399d7a93', '', 0, 'wangwu@yunhe.com', '', '2019-01-24 09:21:45');
INSERT INTO `user` VALUES (5, 'zhaoliu', '4297f44b13955235245b2497399d7a93', '', 0, 'zhaoliu@yunhe.com', '', '2019-01-24 09:35:05');

SET FOREIGN_KEY_CHECKS = 1;
