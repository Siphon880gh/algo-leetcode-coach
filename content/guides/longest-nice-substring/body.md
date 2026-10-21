## Divide at bad characters

1. If `len(s) < 2`, return `""`.
2. `seen = set(s)`. Find the first `i` with `s[i].swapcase() ∉ seen`.
3. None found → `s` is nice. Else recurse on `s[:i]` and `s[i + 1:]`; return the longer, preferring the left on ties.

`"YazaAay"` → `"aAa"` (split at `z`; the right part `"aAay"` then splits at `y`). `"Bb"` → `"Bb"`. `"c"` → `""`.

Prefer the left result on equal length so the earliest occurrence wins. Brute force over all O(n²) substrings also passes for n ≤ 100.

Time: O(n²) worst case  
Space: O(n) recursion

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
