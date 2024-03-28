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

 Date: 12/03/2024 16:23:43
*/


-- ----------------------------
-- Table structure for status_approve
-- ----------------------------
DROP TABLE IF EXISTS "public"."status_approve";
CREATE TABLE "public"."status_approve" (
  "approve_id" int4 NOT NULL DEFAULT nextval('status_approve_approve_id_seq'::regclass),
  "approve_name" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of status_approve
-- ----------------------------
INSERT INTO "public"."status_approve" VALUES (1, 'แก้ไข');
INSERT INTO "public"."status_approve" VALUES (2, 'อนุมัติ');
