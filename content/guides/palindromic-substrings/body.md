## 2n − 1 centers

For each center `c` from 0 to `2n − 2`: `l = c // 2`, `r = l + c % 2`. While `l ≥ 0`, `r < n` and `s[l] == s[r]`: count one, then `l −= 1`, `r += 1`.

Even `c` gives odd-length palindromes (center on a character); odd `c` gives even-length ones (center between two).

DP also works: `p[i][j] = s[i] == s[j] and (j − i < 2 or p[i + 1][j − 1])`, filled by increasing length, counting the true cells. Manacher's algorithm counts in O(n).

Do not expand only around characters; `"aa"` has an even palindrome with its center between the two letters. Do not count distinct strings; equal substrings at different positions count separately (`"aaa"` → 6).

Time: O(n²)  
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
