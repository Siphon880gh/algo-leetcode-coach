## Tiny example

Think about coin change with unlimited coins:

- The best way to make amount `c` is built from the best ways to make smaller amounts. This is **optimal substructure**.
- Once you know the best answer for a smaller amount, later decisions never change what that answer means. This is **no aftereffect**: the state records everything the future needs.

Compare a route through cities where you may not revisit a city. Knowing only "I am in city X" is not enough, because the future also depends on which cities you already used. That does not make DP impossible. It means the state must also record the visited set.

## How

1. Name the state so it holds everything the remaining decisions need.
2. Check that the best answers to smaller states combine into the best answer for the bigger state.
3. Make sure each transition only reads states that are already solved.

## Trap

Forcing DP onto a problem whose future depends on the whole path, without putting that path information into the state.

**Fix:** Add the missing information to the state, or use another approach such as search, or a greedy method you can prove.

**Checklist:** state, transition, base case, fill order · **Time and space:** depend on the problem

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
