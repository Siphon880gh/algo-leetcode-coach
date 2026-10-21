## Count every arrival

1. `g(i, r) = [i == finish] + Σ_{j ≠ i, cost ≤ r} g(j, r − |loc[i] − loc[j]|)` mod 1e9+7.
2. Answer `g(start, fuel)`.

`[2,3,6,8,4]`, start 1, finish 3, fuel 5 → 4. `[4,3,1]`, 1 → 0, fuel 6 → 5. `[5,2,1]`, 0 → 2, fuel 3 → 0.

Do not stop at the first arrival at finish; routes may pass through it and return. Prune when even the direct trip to finish costs more than r.

Time: O(n² · fuel)  
Space: O(n · fuel)

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
