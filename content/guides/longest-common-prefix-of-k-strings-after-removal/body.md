## Trie

1. If n − 1 < k, every answer is 0.
2. Insert all words with counts. good[d] = number of nodes at depth d with count ≥ k; D = the deepest such depth.
3. For word i: the answer is D unless good[D] = 1, word i passes through that node, and its count is exactly k.
4. For those words: walk up from D − 1 to the first depth d where good[d] ≥ 2 or the shared ancestor’s count > k; that d (or 0) is their answer, the same for all of them.

Examples → [3, 4, 4, 3, 4], [0, 0, 0]. Checked against trying every k-subset on 500 random cases.

Answering for the full array: example 1 → [4, 4, 4, 4, 4] instead of [3, 4, 4, 3, 4].

Time: O(total length)  
Space: O(total length)

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
