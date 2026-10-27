## Sort so ties cannot fool you

1. Sort by `(−attack, defense)`.
2. `mx = 0`; for each `(a, d)`: if `d < mx`, count it; `mx = max(mx, d)`.

Examples → 0, 1, 1. Checked against the O(n²) pair check on random inputs.

Within one attack value, defenses ascend, so a same-attack character never raises `mx` above a later one's defense in that group. Every earlier group has strictly higher attack, so `d < mx` means a strictly stronger character exists.

Time: O(n log n)  
Space: O(1) besides sorting

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
