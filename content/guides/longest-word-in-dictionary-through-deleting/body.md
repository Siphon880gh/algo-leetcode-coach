## Subsequence check, then a two-key compare

`isSub(t, s)`: pointer `i` in `t`; for each character of `s`, advance `i` if it matches `t[i]`. `t` is a subsequence when `i == len(t)`.

Keep `best = ""`. For each word `t` that passes, replace `best` if `len(t) > len(best)`, or the lengths are equal and `t < best`.

Alternative: sort the dictionary by `(−len, word)` and return the first word that passes.

Is Subsequence (392) is the single check.

Do not pick the lexicographically smallest overall — length comes first. Do not reorder the letters of `s`; a subsequence keeps order.

Time: O(D · (|s| + L)) where L is the word length (for comparisons)  
Space: O(1) besides the answer

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
