## Tiny example

Backtracking theory on placing numbers into a size-2 path from `{1,2}` without reuse:

Decision tree leaves = permutations. Prune when a partial path repeats a used number.

Correctness = every feasible leaf explored (minus pruned dead ends that cannot win).


## How

1. Define the choice list at each depth
2. Mark/unmark used resources
3. Prune when constraints fail early


## Trap

Pruning without proving the partial path cannot be completed — may drop valid answers.

**Fix:** Only prune when no extension can succeed.

**Time:** O(size of tree explored) · **Space:** O(depth)

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
