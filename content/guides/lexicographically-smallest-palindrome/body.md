## Mirror pairs

1. `i = 0`, `j = n − 1`.
2. While `i < j`: set `s[i] = s[j] = min(s[i], s[j])`; move both inward.
3. Return s.

Examples → efcfe, abba, neven. Checked against trying every palindrome over a, b, c on 300 random short strings.

Each mismatched pair costs exactly one change, so the count is fixed; choosing the smaller letter at every pair makes the string as small as possible. Copying the left half onto the right is not enough: seven → seves instead of neven.

Time: O(n)  
Space: O(n) for the copy

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
