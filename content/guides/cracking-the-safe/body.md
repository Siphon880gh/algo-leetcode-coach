## Codes are edges

Node = the last `n − 1` digits typed. Appending digit `d` to node `u` makes the code `u + d` and moves to the node `(u + d)[1:]`. Every node has `k` outgoing and `k` incoming edges, so an Eulerian circuit exists.

Hierholzer's algorithm, DFS form:

- `dfs(u)`: for each digit `d`, if the edge `u + d` is unused, mark it used, `dfs((u + d)[1:])`, then append `d` to the result.
- Start at `"0" * (n − 1)`. The answer is the appended digits (in the order the DFS appended them) followed by the start node.

The result has `kⁿ` edges plus the `n − 1` starting digits.

Do not try permutations of codes; there are up to 4096 codes. Do not use a greedy "append any new code" walk without backtracking; it can get stuck before covering all codes.

Time: O(kⁿ · k)  
Space: O(kⁿ)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
