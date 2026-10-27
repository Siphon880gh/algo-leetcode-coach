## O(n²) candidates, O(1) checks

1. Precompute prefix hashes of `text`.
2. For `L` from 1 to `n / 2`, for each `i` with `i + 2L ≤ n`: if `hash(i, L) == hash(i + L, L)`, add `hash(i, 2L)` (or the substring) to a set.
3. Return the set size.

`"abcabcabc"` → 3 (`"abcabc"`, `"bcabca"`, `"cabcab"`). `"leetcodeleetcode"` → 2 (`"ee"`, `"leetcodeleetcode"`).

Do not count the same echo twice when it appears at several places; use a set. Do not compare halves character by character in the inner loop; that adds a factor of n.

Time: O(n²) with hashing  
Space: O(n²) for the set in the worst case

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
