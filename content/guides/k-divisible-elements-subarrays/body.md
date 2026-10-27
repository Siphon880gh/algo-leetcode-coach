## Extend and stop early

1. For `i = 0 … n − 1`: `cnt = 0`; for `j = i …`: `cnt += [nums[j] mod p = 0]`; stop when `cnt > k`; insert `nums[i … j]`.
2. Return the set size.

Examples → 11, 10.

A trie over the array values avoids storing whole tuples: walk from each start, and a new trie node is a new distinct subarray.

Time: O(n²) insertions (O(n³) with tuples)  
Space: O(n²)

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
