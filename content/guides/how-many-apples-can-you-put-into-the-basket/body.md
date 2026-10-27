Given apple weights and a basket that holds at most a fixed total weight (the limit is set in the statement; 5000 in the usual version), return the maximum number of apples you can put in. For instance, with a 5000 limit, `[100,200,150,1000]` fits all 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sort and fill

1. Sort `weight` ascending. `total = 0`.
2. For each `w`: if `total + w > limit`, stop; else `total += w` and count it.
3. Return the count.

Swapping any chosen apple for a lighter unchosen one never lowers the count, so the lightest prefix is optimal.

Counting sort over the weight range also works.

Do not take the heaviest apples first; the goal is the number of apples, not weight. Do not skip a heavy apple and keep going; after sorting, every later apple is at least as heavy.

Time: O(n log n)  
Space: O(1) extra

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
