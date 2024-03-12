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

 Date: 12/03/2024 16:23:30
*/


-- ----------------------------
-- Table structure for editprocess_tb
-- ----------------------------
DROP TABLE IF EXISTS "public"."editprocess_tb";
CREATE TABLE "public"."editprocess_tb" (
  "edit_id" int4 NOT NULL DEFAULT nextval('editprocess_tb_edit_id_seq'::regclass),
  "approve_id" int4,
  "edit_date" date,
  "process_id" int4,
  "job_id" int4,
  "detail" text COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of editprocess_tb
-- ----------------------------
