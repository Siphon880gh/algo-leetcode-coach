## Stack of undiscounted items

1. For each `i`: while the stack top's price ≥ `prices[i]`, pop it and subtract `prices[i]` from it.
2. Push `i`.

`[8,4,6,2,3]` → `[4,2,4,2,3]`. `[1,2,3,4,5]` → unchanged. `[10,1,1,6]` → `[9,0,1,6]`.

Do not use strict `>`; an equal later price also counts. A double loop is O(n²) but fine for n ≤ 500.

Time: O(n)  
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
