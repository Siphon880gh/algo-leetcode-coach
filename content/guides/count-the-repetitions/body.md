## Precompute one pass of s1 for every start in s2

Greedy matching is optimal for subsequences: walk `str1` and advance the pointer in `s2` whenever the letters match. Every time the pointer wraps past the end of `s2`, one more copy of `s2` is done.

`str1` can be 1e8 characters long, so do not walk it directly. One copy of `s1` always behaves the same for the same starting pointer `j` in `s2`. Precompute, for each `j` in `0..|s2| − 1`: `cnt[j]` = how many copies of `s2` finish during one pass of `s1`, and `nxt[j]` = the pointer afterwards. That is O(|s1| × |s2|).

Then simulate `n1` passes: `total += cnt[j]`, `j = nxt[j]`. The answer is `total // n2`. Since `j` has at most `|s2|` values, the sequence of `j` cycles; you can detect the cycle to skip ahead, but `n1 ≤ 1e6` passes are already fast.

Is Subsequence (392) is the single-check version. Number of Matching Subsequences (792) checks many words at once.

Do not build `str1` or `str2`. Do not count copies of `str2` directly — count copies of `s2`, then divide by `n2`.

Time: O(|s1| × |s2| + n1)  
Space: O(|s2|)

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
