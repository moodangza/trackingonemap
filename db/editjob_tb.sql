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

 Date: 12/03/2024 16:23:25
*/


-- ----------------------------
-- Table structure for editjob_tb
-- ----------------------------
DROP TABLE IF EXISTS "public"."editjob_tb";
CREATE TABLE "public"."editjob_tb" (
  "editjob_id" int4 NOT NULL DEFAULT nextval('editjob_tb_editjob_tb_seq'::regclass),
  "job_id" int4
)
;

-- ----------------------------
-- Records of editjob_tb
-- ----------------------------
