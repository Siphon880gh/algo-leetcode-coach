Lowercase `s`, length 1 to 150. Encode it as short as possible with the rule `k[encoded]`, meaning `encoded` repeated `k` times, nested as needed. If an encoding is not shorter, do not use it. Any shortest answer is accepted. `"aaa"` → `"aaa"`. `"aaaaa"` → `"5[a]"`. `"aaaaaaaaaa"` → `"10[a]"`. `"aabcaabcd"` → `"2[aabc]d"`. `"abbbabbbcabbbabbbc"` → `"2[2[abbb]c]"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Interval DP over substrings

Let `f[i][j]` be the shortest encoding of `s[i..j]`. Fill by increasing length (or `i` from right to left).

- Start with `f[i][j] = s[i..j]`. Any string shorter than 5 cannot gain: `k[x]` costs at least 4 characters of overhead plus content.
- **Repeat.** Let `t = s[i..j]`. The smallest period `p` is where `t` first appears in `t + t` after index 0. If `p < |t|`, then `t` is `|t| / p` copies of `t[0..p−1]`; candidate `str(|t| / p) + "[" + f[i][i+p−1] + "]"`.
- **Split.** For each `k` in `i..j−1`, candidate `f[i][k] + f[k+1][j]`.

Keep the shortest candidate. Answer `f[0][n−1]`.

Repeated Substring Pattern (459) is the doubled-string trick on its own. Decode String (394) runs the encoding backward.

Do not encode when the result is not shorter (`"aaaa"` stays `"aaaa"` since `"4[a]"` is the same length). Do not forget that the inner part uses its own best encoding (`f[i][i+p−1]`), which is where nesting comes from.

Time: O(n³)  
Space: O(n²) strings (O(n³) characters in the worst case)

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
