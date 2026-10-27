## Window functions

1. first_score = `FIRST_VALUE(score) OVER (PARTITION BY student_id, subject ORDER BY exam_date)`; latest_score the same with `exam_date DESC`; cnt = `COUNT(*)` over the partition.
2. Keep cnt ≥ 2 and latest_score > first_score; `SELECT DISTINCT`; order by student_id, subject.

Example (run in SQLite) → (101, Math, 70, 85), (102, Math, 80, 85), (104, Physics, 75, 85).

Using MIN and MAX score instead: also returns (101, Physics, 60, 65).

Time: O(n log n)  
Space: O(n)

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
