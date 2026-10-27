Given several arrays, each sorted in strictly increasing order, return the longest common subsequence of all of them, i.e. the values present in every array, in increasing order. For instance, [[1,3,4],[1,4,7,9]] → [1,4]; [[2,3,6,8],[1,2,3,5,6,7,10],[2,3,4,6,9]] → [2,3,6]; and [[1,2,3,4,5],[6,7,8]] → []. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Counting

1. Count every value across all arrays.
2. Return the values whose count equals the number of arrays, in increasing order.

Constructed checks (verified with code): the three cases above → `[1,4]`, `[2,3,6]`, `[]`.

Because each array is sorted, any common set of values is automatically a common subsequence in increasing order. If values are bounded (as the statement specifies), an array of counters replaces the map.

Time: O(total length)  
Space: O(distinct values)

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
