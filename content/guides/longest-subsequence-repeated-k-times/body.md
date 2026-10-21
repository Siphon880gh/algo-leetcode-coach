## Grow only what still works

1. `ok` = characters with count ≥ k, in descending order.
2. `level = [""]`; repeat: `next` = `cur + c` for each `cur` in `level`, `c` in `ok`, kept when `(cur + c) * k` is a subsequence of `s`. If `next` is empty, stop; else `best = next[0]`, `level = next`.
3. Return `best`.

Examples → `"let"`, `"b"`, `""`. Checked against every subsequence on random short strings.

If `t` repeats k times, so does every prefix of `t`, so BFS by length loses nothing. Each level is generated in descending order, so its first entry is the lexicographically largest of the longest length. The constraint `n < 8k` keeps lengths below 8.

Time: O(n · C) where C is the number of candidates (small in practice)  
Space: O(C)

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
