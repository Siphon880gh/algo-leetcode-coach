## Sharing window

1. `new[1] = 1`.
2. For `d = 2 … n`: `new[d] = Σ new[j]` for `j` in `[d − forget + 1, d − delay]`, modulo 10^9 + 7.
3. Return `Σ new[j]` for `j` in `[n − forget + 1, n]`.

Examples → 5, 6. Checked against simulating every person on 200 small cases.

A person from day j shares from day j + delay and forgets on day j + forget, sharing on neither that day nor later, hence the window. A running sum makes it O(n), though n ≤ 1000 also allows O(n · forget).

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
