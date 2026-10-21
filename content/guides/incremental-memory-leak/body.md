## Plain simulation

1. `i = 1`.
2. Pick stick 1 if `m1 ≥ m2`, else stick 2.
3. If it has fewer than `i` bits, return `[i, m1, m2]`; else subtract `i` and increment `i`.

`2, 2` → `[3, 1, 0]`. `8, 11` → `[6, 0, 4]`.

Total memory is under 2^32 and the sum 1 + 2 + … + i grows quadratically, so `i` stays below roughly 10^5. Checking only the larger stick is enough: if it can't fit `i`, neither can the other.

Time: O(√(m1 + m2))  
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
