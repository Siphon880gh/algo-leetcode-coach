## Simulate, or index with a BIT

1. Simple: `i = P.index(q)`, record `i`, move `P[i]` to the front.
2. Fast: place values at positions `m + 1 .. 2m` in a Fenwick tree; a query's answer is the count of occupied positions before it; move it to a fresh front slot.

`[3,1,2,1]`, m = 5 → `[2,1,2,1]`. `[4,1,2,2]`, m = 4 → `[3,1,2,0]`. `[7,5,5,8,3]`, m = 8 → `[6,5,0,7,5]`.

Do not report 1-based positions; answers are 0-based. Do not forget to move the value after recording it.

Time: O(q · m) simple, O((q + m) log(q + m)) with a BIT  
Space: O(m), or O(q + m)

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
