## Match lengths

1. ps[i] = longest palindrome in s starting at i; pe[j] = longest palindrome in t ending just before j.
2. f[i][j] = f[i − 1][j + 1] + 1 when s[i] = t[j] (s ending at i mirrors t starting at j).
3. Answer max(longest palindrome in s or t, 2 · f[i][j] + max(ps[i + 1], pe[j])).

With lengths ≤ 30, trying every pair of substrings also works.

Examples → 2, 1, 4, 5. Checked against trying every pair of substrings on 200 random cases.

Requiring both parts to be non-empty: example 3 → 0 instead of 4.

Time: O(n · m + n² + m²) with the palindrome tables built by expanding centers  
Space: O(n · m)

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
