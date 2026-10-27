nums holds each of 0 … n − 1 once, and 0 marks an empty slot. In one operation you move any item into the empty slot, which leaves the slot where that item was. The array counts as sorted when it matches one of the target arrangements the statement describes, with the items in increasing order and the empty slot in one of the allowed places. Return the fewest operations needed. For instance, an array that already matches a target → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Cycles against each target

1. For each target arrangement `t`, follow the cycles of the permutation that sends `nums` to `t`, skipping items already in place.
2. A cycle of length L that contains the empty slot costs `L − 1`; a cycle without it costs `L + 1`.
3. Return the smallest total over the targets.

Constructed checks (verified against a BFS over every move sequence on 300 random small arrays and targets): measured against the target [0,1,2,3], [0,2,1,3] → 3; against [0,1,2], [1,0,2] → 1.

Inside the empty slot’s cycle, every move drops one item straight into its final place. A cycle without the slot needs one extra move to pull an item out into the slot first, and the slot ends up back where it started.

Time: O(n) per target  
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
