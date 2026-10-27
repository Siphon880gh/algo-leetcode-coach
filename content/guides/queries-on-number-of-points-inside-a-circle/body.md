## Integer test

For each query `(cx, cy, r)`: count points with `(x − cx)² + (y − cy)² ≤ r²`.

Example 1 → `[3,2,2]`. Example 2 → `[2,3,2,4]`.

Compare squares to avoid floating-point roots; `≤` includes border points. For the follow-up, sort points by x and only scan those with `|x − cx| ≤ r`.

Time: O(points · queries)  
Space: O(queries)

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
