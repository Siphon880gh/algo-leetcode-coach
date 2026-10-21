`strs` has 2 to 50 strings, each 1 to 10 lowercase letters. An uncommon subsequence is a subsequence of one string that is not a subsequence of any other. Return the longest length, or −1. `["aba","cdc","eae"]` → 3. `["aaa","aaa","aa"]` → −1.

## Whole strings are enough

If `t` is a subsequence of `strs[i]` and of no other string, then `strs[i]` itself is not a subsequence of any other string either (anything containing `strs[i]` would contain `t`). And `strs[i]` is at least as long as `t`. So only whole strings matter.

For each `i`, check every `j != i`: is `strs[i]` a subsequence of `strs[j]`? Use the two-pointer test (advance in `strs[j]`, match in `strs[i]`). If none contains it, `len(strs[i])` is a candidate. Return the max, or −1.

Sorting by length descending lets you return the first string that passes.

Longest Uncommon Subsequence I (521) is the two-string case.

Do not skip duplicates without care — a string that appears twice is a subsequence of its copy, so it fails, which the `j != i` check already handles. Do not compare only against longer strings — an equal-length duplicate also blocks it.

Time: O(n² · L)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
