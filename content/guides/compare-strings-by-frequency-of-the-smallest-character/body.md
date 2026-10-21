## Bucket the f values

1. `f(s) = s.count(min(s))`.
2. `cnt[v]` = words with `f = v`, for `v` in `1..10`; `more[v] = Σ cnt[u]` for `u > v`.
3. Answer for query `q`: `more[f(q)]`.

`queries = ["bbb","cc"]`, `words = ["a","aa","aaa","aaaa"]` → `[1,2]`.

Sorting the word values and using `bisect_right` works too.

Do not recompute f(word) for every query; compute each word's value once. Do not use `≥`; the word must be strictly greater.

Time: O((q + w) · L)  
Space: O(1) beyond the output

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
