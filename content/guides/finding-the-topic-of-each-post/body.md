A table Keywords lists topic_id and word pairs (a topic can have several keywords), and a table Posts lists post_id and content. A post belongs to a topic when one of that topic’s keywords appears in its content as a whole word, ignoring case. For each post, return its topic ids as a comma-separated list of distinct ids in ascending order, or the string Ambiguous! when it matches no topic. For instance, content “stop the war and play handball” with keywords WAR (topic 3) and handball (topic 1) → 1,3; “warning” does not match WAR. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Whole words via padding

Using the column names the statement gives: take the output format from it too.

1. `Posts LEFT JOIN Keywords ON CONCAT(' ', LOWER(content), ' ') LIKE CONCAT('% ', LOWER(word), ' %')`.
2. `GROUP BY post_id`; `GROUP_CONCAT(DISTINCT topic_id ORDER BY topic_id)`.
3. `IFNULL(…, 'Ambiguous!')`.

Constructed check (run in SQLite with an ordered subquery): posts about football, handball and football, “stop the war and play handball”, and “warning … vaccinated” → 1, 1, 1,3, Ambiguous!.

The padding stops war matching warning; LOWER on both sides handles case. DISTINCT matters when two keywords of one topic both appear.

Time: O(posts · keywords · length)  
Space: O(posts)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
