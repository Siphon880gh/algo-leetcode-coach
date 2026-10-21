## Rolling bits

1. If `len(s) − k + 1 < 2^k`, return false at once.
2. `h = ((h << 1) | bit) & (2^k − 1)`; once `i ≥ k − 1`, mark `seen[h]`.
3. Return whether the number of marked codes equals `2^k`.

`"00110110"`, 2 → true. `"0110"`, 1 → true. `"0110"`, 2 → false.

Do not generate all 2^k codes and search for each; that is O(2^k · n).

Time: O(n)  
Space: O(2^k)

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
