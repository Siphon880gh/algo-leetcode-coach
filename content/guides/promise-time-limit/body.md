## Race

1. Return `(...args) => new Promise((resolve, reject) => { … })`.
2. Inside: `id = setTimeout(() => reject("Time Limit Exceeded"), t)`.
3. `fn(...args).then(v => { clearTimeout(id); resolve(v) }, e => { clearTimeout(id); reject(e) })`.

Examples → rejected at 50, resolved 25 at 100, resolved 15 at 120, rejected Error at 0. Checked in Node.

A promise settles only once, so whichever side comes second is ignored. Promise.race with a timeout promise is an equivalent one-liner.

Time: O(1) work  
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
