Given an array and a list of queries, each query either sets one element, asks for the XOR of a range, or reverses a range in place. Return the answers to the XOR queries in order. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Split and merge

1. Build the treap in array order; each node keeps size, XOR of its subtree, and a reverse flag (pushed down before use by swapping children).
2. Set: split at index and index + 1, change the value, merge back.
3. XOR: split out [l, r], read its XOR, merge back.
4. Reverse: split out [l, r], toggle its flag, merge back.

Constructed checks (run in code): [4, 7, 1] with XOR(0, 2), reverse(0, 2), set(0, 5), XOR(0, 1) → [2, 2]; [1, 2, 3] with reverse(0, 2), set(0, 9), XOR(2, 2) → [1]. Checked against a plain list on 300 random cases.

Skipping reversals (XOR of a range does not change, but positions do): the second check → [3] instead of [1].

Time: O(log n) expected per query  
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
