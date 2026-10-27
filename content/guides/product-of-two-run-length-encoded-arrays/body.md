Two run-length encoded arrays are given as lists of [value, frequency] pairs and expand to arrays of the same length. Return the run-length encoding of their element-wise product, using as few runs as possible (adjacent runs with equal values are merged). For instance, [[1,3],[2,3]] × [[6,3],[3,3]] → [[6,6]], and [[1,3],[2,1],[3,2]] × [[2,3],[3,3]] → [[2,3],[6,1],[9,2]]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Consume runs in lockstep

1. `i = j = 0`.
2. `f = min(rem1, rem2)`, `v = a[i].value · b[j].value`.
3. If the last output run has value `v`, add `f` to it; else append `[v, f]`.
4. Subtract `f` from both; advance any pointer whose run hits 0.

Constructed checks (verified with code): the two cases above, plus `[[2,2],[1,2]] × [[1,2],[2,2]]` → `[[2,4]]`.

Never expand the arrays: frequencies can be large. The merge in step 3 is what makes the output minimal.

Time: O(len(a) + len(b))  
Space: O(1) besides the output

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
