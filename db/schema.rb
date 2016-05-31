# encoding: UTF-8
# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended to check this file into your version control system.

ActiveRecord::Schema.define(:version => 20150910100554) do

  create_table "appointments", :force => true do |t|
    t.decimal  "client_id",     :precision => 10, :scale => 0
    t.date     "due_date"
    t.decimal  "total_drugs",   :precision => 10, :scale => 0
    t.decimal  "taken_evening", :precision => 10, :scale => 0
    t.decimal  "taken_morning", :precision => 10, :scale => 0
    t.decimal  "created_by",    :precision => 10, :scale => 0
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "status"
  end

  create_table "client_medicals", :force => true do |t|
    t.decimal  "client_id",      :precision => 10, :scale => 0
    t.string   "regimen"
    t.string   "sulphur_allegy"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "clients", :force => true do |t|
    t.string   "arv_number"
    t.date     "dob"
    t.string   "gender"
    t.string   "education"
    t.string   "occupation"
    t.string   "marital_status"
    t.string   "literacy_level"
    t.string   "phone"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "item_types", :force => true do |t|
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "items", :force => true do |t|
    t.string   "name"
    t.text     "description"
    t.decimal  "unit_price",   :precision => 10, :scale => 0
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "item_type_id"
    t.integer  "user_id"
    t.boolean  "status"
    t.decimal  "active_id",    :precision => 10, :scale => 0
  end

  create_table "sales", :force => true do |t|
    t.integer  "item_id"
    t.integer  "quantity"
    t.string   "customer"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "user_id"
    t.string   "discount"
  end

  create_table "stocks", :force => true do |t|
    t.integer  "item_id"
    t.integer  "quantity"
    t.text     "supplier"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "user_id"
  end

  create_table "users", :force => true do |t|
    t.string   "first_name"
    t.string   "surname"
    t.string   "phone",              :limit => 11
    t.string   "encrypted_password", :limit => 40,                    :null => false
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "salt",               :limit => 40
    t.boolean  "admin",                            :default => false
    t.text     "profile"
    t.string   "email"
  end

end
