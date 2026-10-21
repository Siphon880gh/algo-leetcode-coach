## Per query

1. Slice `nums[l..r]`; sort it.
2. True iff every adjacent difference equals the first one.
3. O(len) alternative: `d = (max − min) / (len − 1)` must be an integer; all `(v − min) / d` distinct and in range (d = 0 means all equal).

`[4,6,5,9,3,7]` with `l = [0,0,2]`, `r = [2,3,5]` → `[true,false,true]`. Example 2 → `[false,true,false,false,true,true]`.

n, m ≤ 500 make sorting per query fine.

Time: O(m · n log n)  
Space: O(n)

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
