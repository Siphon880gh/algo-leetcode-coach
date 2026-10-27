## Switch at intersections

1. `i = j = 0`, `s1 = s2 = 0`.
2. Smaller side advances and adds to its sum. On equal values: `s1 = s2 = max(s1, s2) + v`; advance both.
3. Drain the remainders; return `max(s1, s2) mod 1e9+7`.

`[2,4,5,8,10]`, `[4,6,8,9]` → 30. `[1,3,5,7,9]`, `[3,5,100]` → 109. Disjoint arrays → 40.

Do not take the modulo before comparing sums; keep exact 64-bit (or big) values until the end.

Time: O(n + m)  
Space: O(1)

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
