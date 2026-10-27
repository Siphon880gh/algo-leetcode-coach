## Outside in

1. While length > 2: let `j` = last index with `s[j] = s[0]`.
2. If `j = 0`: swap `s[0]` and `s[1]`, add 1, and continue.
3. Else add `len − 1 − j`, delete `s[j]` and `s[0]`.

Examples → 2, 2. Checked against BFS over all swap sequences on 300 short palindromable strings.

Pairing the first character with its farthest copy never crosses another pair needlessly. n ≤ 2000, so the O(n²) deletions are fine; a Fenwick tree makes it O(n log n).

Time: O(n²)  
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
