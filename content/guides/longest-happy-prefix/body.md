## Prefix function

1. `pi[0] = 0`, `k = 0`.
2. For `i` from 1: while `k > 0` and `s[i] ≠ s[k]`, `k = pi[k − 1]`; if equal, `k += 1`; `pi[i] = k`.
3. Return `s[: pi[n − 1]]`.

`"level"` → `"l"`. `"ababab"` → `"abab"`.

Do not compare every prefix with its suffix; that is O(n²). Do not return the whole string; the prefix must be proper. Rolling hashes also work in O(n).

Time: O(n)  
Space: O(n)

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
