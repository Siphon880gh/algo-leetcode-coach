Given an m × n 0/1 grid where grid[i][j] = 1 means boy i may invite girl j, each boy invites at most one girl and each girl accepts at most one invitation. Return the maximum number of accepted invitations. For instance, [[1,1,1],[1,0,1],[0,0,1]] → 3 and [[1,1],[0,0]] → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Kuhn's augmenting paths

1. `match[girl] = −1`.
2. For each boy: `try(boy, seen)`: for each girl he may invite, not yet seen this round: mark; if she is free or `try(match[girl])` succeeds, set `match[girl] = boy`, return true.
3. Count successes.

Constructed checks (verified against brute force over all assignments): `[[1,1,1],[1,0,1],[0,0,1]]` → 3, `[[1,0,1,0],[1,0,0,0],[0,0,1,0],[1,1,1,0]]` → 3, `[[1,1],[0,0]]` → 1.

Reset `seen` for each boy. Greedy first-free assignment fails: in the first example boys 0 and 1 take girls 0 and 2, leaving boy 2 (who can only invite girl 2) unmatched, so greedy gets 2 instead of 3.

Time: O(m · m · n)  
Space: O(m + n)

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
