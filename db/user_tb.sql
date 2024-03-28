/*
 Navicat Premium Data Transfer

 Source Server         : real
 Source Server Type    : PostgreSQL
 Source Server Version : 130002 (130002)
 Source Host           : localhost:5432
 Source Catalog        : postgres
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 130002 (130002)
 File Encoding         : 65001

 Date: 12/03/2024 16:23:55
*/


-- ----------------------------
-- Table structure for user_tb
-- ----------------------------
DROP TABLE IF EXISTS "public"."user_tb";
CREATE TABLE "public"."user_tb" (
  "user_id" int4 NOT NULL DEFAULT nextval('user_user_id_seq'::regclass),
  "user_name" varchar(255) COLLATE "pg_catalog"."default",
  "password" varchar(255) COLLATE "pg_catalog"."default",
  "level" varchar(1) COLLATE "pg_catalog"."default",
  "created_at" timestamp(6),
  "update_at" timestamp(6)
)
;

-- ----------------------------
-- Records of user_tb
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table user_tb
-- ----------------------------
ALTER TABLE "public"."user_tb" ADD CONSTRAINT "user_pkey" PRIMARY KEY ("user_id");
