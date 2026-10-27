## Two pointers on sorted lists

1. Sort `players` and `trainers`; `i = 0`.
2. For each trainer `t` in order: if `i < len(players)` and `players[i] ≤ t`, `i++`.
3. Return `i`.

Examples → 2, 1.

A trainer that cannot take the weakest remaining player cannot take anyone, so skipping it loses nothing, and giving it the weakest player leaves stronger trainers for stronger players. This is the same problem as 455 Assign Cookies.

Time: O(n log n + m log m)  
Space: O(1) beyond sorting

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
