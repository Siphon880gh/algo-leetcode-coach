`strs` has 1 to 1000 lowercase strings with total length at most 1000. Concatenate them in the given order into a loop, choosing to reverse each one or not. Then cut the loop at any point to make a regular string starting at the cut. Return the lexicographically largest result. `["abc","xyz"]` → `"zyxcba"`. `["abc"]` → `"cba"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Only the cut string is special

Every string that the cut does not split appears whole inside the result, after the cut and before the wrap. Using the larger of `s` and `reverse(s)` for each of them can only help (same length, so a larger piece at a fixed position gives a larger result). So first replace every string with `max(s, s[::-1])`.

Then try each string `i` as the one containing the cut. For both orientations `cur` (the string and its reverse) and each cut position `j`:

`candidate = cur[j:] + strs[i+1] + … + strs[n−1] + strs[0] + … + strs[i−1] + cur[:j]`

Keep the largest. With total length `L <= 1000`, this is O(L²) work.

Do not fix the cut string's orientation from the greedy max — the best cut may need the other orientation (for example to start at a large letter). Do not reverse the order of the strings; only each string can be reversed.

Time: O(L²)  
Space: O(L)

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
