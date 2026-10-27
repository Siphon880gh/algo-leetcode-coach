Each block takes a given time to build, and one worker builds one block and then stops. A worker can also split into two workers, which takes a fixed `split` time. Starting with one worker, return the minimum time to build all blocks. For instance, `[1,2]` with `split = 5` takes 7, and `[1,2,3]` with `split = 1` takes 4. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Combine the two smallest

1. Heapify `blocks`.
2. While more than one value: `a = pop`, `b = pop` (`a ≤ b`), push `split + b`.
3. Return the remaining value.

Merging two subtrees under one split costs `split + max`, and like Huffman coding, putting the shortest jobs deepest is optimal.

`[1,2,3]`, split 1: merge 1, 2 → 3; merge 3, 3 → 4.

Do not add `a + b`; the two workers run in parallel, so only the larger counts. Do not merge the largest first; they should be split off earliest.

Time: O(n log n)  
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
