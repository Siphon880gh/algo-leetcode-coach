## Largest suffix in O(n)

`i = 0`, `j = 1`, `k = 0`. While `j + k < n`:

- `s[i + k] == s[j + k]`: `k += 1`.
- `s[i + k] > s[j + k]`: `j = j + k + 1`, `k = 0`.
- `s[i + k] < s[j + k]`: `i = max(i + k + 1, j)`, `j = i + 1`, `k = 0`.

Return `s[i:]`.

`"abab"` → `"bab"`, `"leetcode"` → `"tcode"`.

A start inside a losing run is beaten by the matching start in the winning run, so skipping by `k + 1` is safe.

Do not sort or compare all suffixes; that is O(n²) for 4 · 10⁵ characters. Do not reset `j` to `i + 1` without the `max`; it can revisit starts.

Time: O(n)  
Space: O(1)

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
