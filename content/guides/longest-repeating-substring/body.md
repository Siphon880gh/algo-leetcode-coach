Given a string `s` (length up to 2000, lowercase letters), return the length of the longest substring that occurs at least twice; occurrences may overlap. Return 0 if none exists. `"abcd"` → 0. `"abbaba"` → 2 (`"ab"`, `"ba"`). `"aabcaabdaab"` → 3 (`"aab"`). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two end positions

`dp[i][j]` (1-indexed, `i < j`) = length of the longest common substring ending at `s[i − 1]` and `s[j − 1]`.

- If `s[i − 1] == s[j − 1]`: `dp[i][j] = dp[i − 1][j − 1] + 1`, and update `ans`.
- Else `dp[i][j] = 0`.

Return `ans`.

Requiring `i < j` keeps the two occurrences at different starts; overlap is allowed.

For longer strings, binary search the length and check each length with a rolling hash set (as in Longest Duplicate Substring). Do not compare every pair of substrings directly; that is O(n³) or worse.

Time: O(n²)  
Space: O(n²), or O(n) with one rolling row

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
