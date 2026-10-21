## One max, one pass

1. `m = max(candies)`.
2. Return `[c + extraCandies >= m for c in candies]`.

`[2,3,5,1,3]`, extra 3 → `[true,true,true,false,true]`. `[4,2,1,1,2]`, extra 1 → `[true,false,false,false,false]`. `[12,1,12]`, extra 10 → `[true,false,true]`.

Do not recompute the max per kid. Do not use `>`; a tie counts as greatest.

Time: O(n)  
Space: O(1) extra

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
