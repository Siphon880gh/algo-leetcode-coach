`pid[i]` is a process id and `ppid[i]` is its parent (0 for the root). The processes form one tree. Killing a process also kills all of its descendants. Return every pid that dies when you kill `kill`, in any order. `pid = [1,3,10,5]`, `ppid = [3,0,5,3]`, `kill = 5` → `[5,10]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Children map, then a traversal

1. Build `children[p]`: for each `i`, append `pid[i]` to `children[ppid[i]]`.
2. Start a queue (or stack) with `kill`. Pop a pid, add it to the answer, and push all its children.

Every process is visited once, so the whole job is linear.

Do not scan the `ppid` list again for every killed process; that is O(n²) on a long chain. Do not forget to include `kill` itself in the answer.

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
