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

 Date: 12/03/2024 16:23:21
*/


-- ----------------------------
-- Table structure for division_tb
-- ----------------------------
DROP TABLE IF EXISTS "public"."division_tb";
CREATE TABLE "public"."division_tb" (
  "division_id" int4 NOT NULL DEFAULT nextval('division_tb_division_id_seq'::regclass),
  "division_name" varchar COLLATE "pg_catalog"."default",
  "division_short" varchar COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of division_tb
-- ----------------------------
INSERT INTO "public"."division_tb" VALUES (1, 'สำนักงานการปฏิรูปที่ดินเพื่อเกษตรกรรม', 'ส.ป.ก.');
INSERT INTO "public"."division_tb" VALUES (2, 'กรมอุทยาน', 'อุทยาน');
INSERT INTO "public"."division_tb" VALUES (3, 'กรมป่าไม้', 'ปม.');
INSERT INTO "public"."division_tb" VALUES (4, 'กรมพัฒนาที่ดิน', 'พด.');
INSERT INTO "public"."division_tb" VALUES (5, 'กรมที่ดิน', 'ทด.');
