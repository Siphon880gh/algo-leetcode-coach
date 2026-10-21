## Two lower bounds, and they are tight

If `total % n != 0`, return −1. Otherwise `avg = total / n` and each machine has excess `a_i = machines[i] − avg`.

- **Flow across a boundary.** Let `s` be the prefix sum of `a` up to `i`. Exactly `|s|` dresses must cross the boundary after `i`, and at most one crosses per move. So the answer is at least `|s|`.
- **One machine's output.** A machine can give away only one dress per move, even with two neighbors. A machine with excess `a_i > 0` needs at least `a_i` moves.

Answer = max over `i` of `max(|s_i|, a_i)`. A machine *receiving* can take from both sides at once, so negative `a_i` is not a separate bound.

`[0,3,0]`: avg 1, a = `[−1,2,−1]`, prefixes `−1,1,0` → max(1, 2) = 2.

Do not use `|a_i|` for the per-machine bound — a machine with −2 can receive from both neighbors in one move. Do not sum the moves; they run in parallel.

Time: O(n)  
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
